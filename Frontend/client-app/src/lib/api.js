import axios from 'axios';

let authToken = null;

export const setAuthToken = (token) => {
    authToken = token;
}

export const api = axios.create( {
    baseURL: process.env.NEXT_PUBLIC_BASE_URL,
});

api.interceptors.request.use((config) => {
    config.headers["Authorization"] = `Bearer ${authToken}`;
    return config;
});

