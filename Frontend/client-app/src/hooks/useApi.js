
import { useAuth } from '@/context/AuthContext';
import { apiClient } from '@/lib/api';
import { useState } from 'react';

export const useApi = () => {
    const { logout } = useAuth();
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);

    const request = async (method, url, data = null, config = {}) => {
        setLoading(true);
        setError(null);

        try {
            const response = await apiClient[method](url, data, config);
            return response;
        } catch (err) {
            setError(err.message);

            // Se for erro de auth, faz logout
            if (err.response?.status === 401) {
                await logout();
            }

            throw err;
        } finally {
            setLoading(false);
        }
    };

    return {
        loading,
        error,
        clearError: () => setError(null),
        get: (url, config) => request('get', url, null, config),
        post: (url, data, config) => request('post', url, data, config),
        put: (url, data, config) => request('put', url, data, config),
        delete: (url, config) => request('delete', url, null, config),
    };
};