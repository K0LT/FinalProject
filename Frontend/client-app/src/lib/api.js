import axios from 'axios';

// CSRF and Cookie helpers (moved from authClient.js)
function getCookie(name) {
    if (typeof document === "undefined") return null;
    const match = document.cookie.match(
        new RegExp("(^|; )" + name + "=([^;]*)"),
    );
    return match ? decodeURIComponent(match[2]) : null;
}

function deleteCookie(name) {
    if (typeof document === "undefined") return;
    document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}

async function ensureCsrf() {
    if (typeof window === "undefined") return;

    const ROOT = (process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000").replace(/\/api\/?$/, "");

    await fetch(`${ROOT}/sanctum/csrf-cookie`, {
        method: "GET",
        credentials: "include",
    });
}

async function refreshCsrfToken() {
    if (typeof window === "undefined") return;

    // Clear old XSRF token
    deleteCookie("XSRF-TOKEN");

    // Fetch new one
    await ensureCsrf();
}

class ApiClient {
    constructor() {
        this.client = axios.create({
            baseURL: process.env.NEXT_PUBLIC_API_URL,
            timeout: 10000,
            withCredentials: true,
        });

        this.setupInterceptors();
    }

    setupInterceptors() {
        this.client.interceptors.request.use(
            (config) => {
                const token = this.getToken();
                const xsrf = getCookie("XSRF-TOKEN");

                if (token) {
                    config.headers.Authorization = `Bearer ${token}`;
                }
                config.headers['X-Requested-With'] = 'XMLHttpRequest';

                // Only set XSRF token if it exists
                if (xsrf) {
                    config.headers['X-XSRF-TOKEN'] = xsrf;
                }

                return config;
            },
            (error) => Promise.reject(error)
        );

        this.client.interceptors.response.use(
            (response) => response,
            async (error) => {
                const originalRequest = error.config;

                // Handle CSRF token mismatch (419)
                if (error.response?.status === 419 && !originalRequest._retry) {
                    originalRequest._retry = true;

                    console.log('CSRF token mismatch detected, refreshing token...');

                    try {
                        // Refresh CSRF token
                        await refreshCsrfToken();

                        // Update the header with new token
                        const newXsrf = getCookie("XSRF-TOKEN");
                        if (newXsrf) {
                            originalRequest.headers['X-XSRF-TOKEN'] = newXsrf;
                        }

                        // Retry the original request
                        return this.client(originalRequest);
                    } catch (refreshError) {
                        console.error('Failed to refresh CSRF token:', refreshError);
                        return Promise.reject(error);
                    }
                }

                // Handle unauthorized (401)
                if (error.response?.status === 401) {
                    this.clearToken();
                    if (typeof window !== 'undefined') {
                        localStorage.removeItem('user_data');
                        window.location.href = '/login';
                    }
                }

                return Promise.reject(error);
            }
        );
    }


    getToken() {
        if (typeof window === 'undefined') return null;
        return localStorage.getItem('auth_token');
    }

    setToken(token) {
        if (typeof window === 'undefined') return;
        localStorage.setItem('auth_token', token);
    }

    clearToken() {
        if (typeof window === 'undefined') return;
        localStorage.removeItem('auth_token');
    }

    async request(config) {
        try {
            const response = await this.client(config);
            return response.data;
        } catch (error) {
            throw new Error(
                error.response?.data?.message ||
                error.message ||
                'Request failed'
            );
        }
    }

    async login(credentials) {
        await ensureCsrf();
        const response = await this.request({
            method: 'POST',
            url: '/login',
            data: credentials,
        });
        this.setToken(response.auth_token);
        if (typeof window !== 'undefined') {
            localStorage.setItem('user_data', JSON.stringify(response.user));
        }

        return response;
    }

    async logout() {
        try {
            await this.request({
                method: 'POST',
                url: '/logout',
            });
        } catch (error) {
            console.error('Logout error:', error);
        } finally {
            this.clearToken();
            if (typeof window !== 'undefined') {
                localStorage.removeItem('user_data');
            }
        }
    }

    async getCurrentUser() {
        return this.request({
            method: 'GET',
            url: '/user',
        });
    }

    get(url, config = {}) {
        return this.request({ method: 'GET', url, ...config });
    }

    post(url, data = {}, config = {}) {
        return this.request({ method: 'POST', url, data, ...config });
    }

    put(url, data = {}, config = {}) {
        return this.request({ method: 'PUT', url, data, ...config });
    }

    delete(url, config = {}) {
        return this.request({ method: 'DELETE', url, ...config });
    }
}

export const apiClient = new ApiClient();