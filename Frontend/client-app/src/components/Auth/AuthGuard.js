'use client';

import { useAuth } from '@/context/AuthContext';
import { useRouter, usePathname } from 'next/navigation';
import { useEffect } from 'react';

export const AuthGuard = ({
                              children,
                              requireAuth = true,
                              redirectTo = '/login'
                          }) => {
    const { isAuthenticated, isLoading } = useAuth();
    const router = useRouter();
    const pathname = usePathname();

    useEffect(() => {
        if (!isLoading) {
            if (requireAuth && !isAuthenticated) {
                const redirectUrl = `/login?redirect=${encodeURIComponent(pathname)}`;
                router.push(redirectUrl);
            } else if (!requireAuth && isAuthenticated) {
                router.push(redirectTo);
            }
        }
    }, [isAuthenticated, isLoading, requireAuth, router, pathname, redirectTo]);

    if (isLoading) {
        return (
            <div className="min-h-screen flex items-center justify-center">
                <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            </div>
        );
    }

    if (requireAuth && !isAuthenticated) {
        return null;
    }

    if (!requireAuth && isAuthenticated) {
        return null;
    }

    return children;
};