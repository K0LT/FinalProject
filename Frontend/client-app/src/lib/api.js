import axios from 'axios';
import {ensureCsrf} from "@/lib/authClient";
import {getCookie} from "@/lib/authClient";


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
                ensureCsrf();
                const xsrf = getCookie("XSRF-TOKEN");
                if (token) {
                    config.headers.Authorization = `Bearer ${token}`;
                }
                config.headers['X-Requested-With'] = 'XMLHttpRequest';
                config.headers['X-XSRF-TOKEN'] = xsrf;
                return config;
            },
            (error) => Promise.reject(error)
        );

        this.client.interceptors.response.use(
            (response) => response,
            (error) => {
                if (error.response?.status === 401) {
                    this.clearToken();
                    if (typeof window !== 'undefined') {
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
        localStorage.removeItem('user_data');
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
        const response = await this.request({
            method: 'POST',
            url: '/login',
            data: credentials,
        });

        this.setToken(response.token);
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