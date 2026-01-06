'use client';

import React, { useEffect } from 'react';
import { AuthProvider, useAuth } from './AuthContext';
import { apiClient } from '@/lib/api';

/**
 * DevAuthInjector - Internal component that injects dev mode data
 * This runs INSIDE the AuthProvider context
 */
function DevAuthInjector({ children }) {
    const { user } = useAuth();

    useEffect(() => {
        const initDevMode = async () => {
            if (typeof window === 'undefined') return;

            // Skip if already authenticated
            if (user) return;

            const devMode = localStorage.getItem('dev_auto_login') === 'true';

            if (devMode && process.env.NODE_ENV === 'development') {
                console.log('🔓 DEV: Auto-login ativo');

                const mockUser = {
                    id: 1,
                    name: "Developer",
                    email: "dev@example.com",
                    role: { name: "patient" },
                    patient: { phone_number: "+351912345678" }
                };
                const mockToken = "dev-token";

                // Set token and user data in storage
                apiClient.setToken(mockToken);
                localStorage.setItem('user_data', JSON.stringify(mockUser));

                // Reload to trigger auth check in AuthContext
                window.location.reload();
            }
        };

        initDevMode();
    }, [user]);

    return children;
}

/**
 * DevAuthProvider - Wraps AuthProvider with dev mode capabilities
 */
export function DevAuthProvider({ children }) {
    if (process.env.NODE_ENV !== 'development') {
        // In production, just use regular AuthProvider
        return <AuthProvider>{children}</AuthProvider>;
    }

    return (
        <AuthProvider>
            <DevAuthInjector>
                {children}
            </DevAuthInjector>
        </AuthProvider>
    );
}
