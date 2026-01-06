'use client';

import React, {
    createContext,
    useContext,
    useReducer,
    useEffect,
    useCallback
} from 'react';
import { apiClient } from '@/lib/api';

const AuthContext = createContext();

const authReducer = (state, action) => {
    switch (action.type) {
        case 'AUTH_START':
            return { ...state, isLoading: true, error: null };
        case 'AUTH_SUCCESS':
            return {
                user: action.payload.user,
                token: action.payload.token,
                isAuthenticated: true,
                isLoading: false,
                error: null,
            };
        case 'AUTH_FAILURE':
            return {
                user: null,
                token: null,
                isAuthenticated: false,
                isLoading: false,
                error: action.payload,
            };
        case 'AUTH_LOGOUT':
            return {
                user: null,
                token: null,
                isAuthenticated: false,
                isLoading: false,
                error: null,
            };
        case 'AUTH_CLEAR_ERROR':
            return {
                ...state,
                error: null,
            };
        default:
            return state;
    }
};

const initialState = {
    user: null,
    token: null,
    isAuthenticated: false,
    isLoading: true,
    error: null,
};

export const AuthProvider = ({ children }) => {
    const [state, dispatch] = useReducer(authReducer, initialState);

    useEffect(() => {
        const checkAuth = async () => {
            if (typeof window === 'undefined') return;

            try {
                const token = apiClient.getToken();
                const userData = localStorage.getItem('user_data');
                const user = userData ? JSON.parse(userData) : null;

                if (token && user) {
                    try {
                        const currentUser = await apiClient.getCurrentUser();
                        dispatch({
                            type: 'AUTH_SUCCESS',
                            payload: { user: currentUser, token },
                        });
                    } catch (error) {
                        await apiClient.logout();
                        dispatch({
                            type: 'AUTH_FAILURE',
                            payload: 'Sessão expirada'
                        });
                    }
                } else {
                    dispatch({ type: 'AUTH_FAILURE', payload: null });
                }
            } catch (error) {
                dispatch({
                    type: 'AUTH_FAILURE',
                    payload: 'Erro de autenticação'
                });
            }
        };

        checkAuth();
    }, []);

    const login = useCallback(async (credentials) => {
        dispatch({ type: 'AUTH_START' });

        try {
            const response = await apiClient.login(credentials);
            dispatch({
                type: 'AUTH_SUCCESS',
                payload: response,
            });
            return response;
        } catch (error) {
            dispatch({ type: 'AUTH_FAILURE', payload: error.message });
            throw error;
        }
    }, []);

    const logout = useCallback(async () => {
        try {
            await apiClient.logout();
        } catch (error) {
            console.error('Logout error:', error);
        } finally {
            dispatch({ type: 'AUTH_LOGOUT' });
        }
    }, []);

    const clearError = useCallback(() => {
        dispatch({ type: 'AUTH_CLEAR_ERROR' });
    }, []);

    const value = {
        ...state,
        login,
        logout,
        clearError,
    };

    return (
        <AuthContext.Provider value={value}>
            {children}
        </AuthContext.Provider>
    );
};

export const useAuth = () => {
    const context = useContext(AuthContext);
    if (context === undefined) {
        throw new Error('useAuth must be used within AuthProvider');
    }
    return context;
};