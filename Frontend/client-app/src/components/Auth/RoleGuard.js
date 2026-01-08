'use client';

import { useAuth } from '@/context/AuthContext';
import { useRouter } from 'next/navigation';
import { useEffect } from 'react';
import { getDashboardRoute } from '@/lib/roleHelpers';

/**
 * RoleGuard - Protects routes based on user roles
 *
 * @param {Object} props
 * @param {Array<number>} props.allowedRoles - Array of role IDs that can access this route
 * @param {ReactNode} props.children - Content to render if authorized
 * @param {string} props.redirectTo - Where to redirect unauthorized users (optional, defaults to role-based dashboard)
 */
export const RoleGuard = ({
    children,
    allowedRoles = [],
    redirectTo = null
}) => {
    const { user, isAuthenticated, isLoading } = useAuth();
    const router = useRouter();

    useEffect(() => {
        if (!isLoading && isAuthenticated && user) {
            // Check if user's role is in the allowed roles
            const hasAccess = allowedRoles.includes(user.role_id);

            if (!hasAccess) {
                // Redirect to appropriate dashboard based on role
                const targetRoute = redirectTo || getDashboardRoute(user);
                console.warn(`Access denied. Redirecting to ${targetRoute}`);
                router.push(targetRoute);
            }
        }
    }, [user, isAuthenticated, isLoading, allowedRoles, redirectTo, router]);

    // Show loading state
    if (isLoading) {
        return (
            <div className="min-h-screen flex items-center justify-center">
                <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            </div>
        );
    }

    // Not authenticated - AuthGuard should handle this
    if (!isAuthenticated) {
        return null;
    }

    // Check authorization
    if (user && !allowedRoles.includes(user.role_id)) {
        // Show unauthorized message briefly before redirect
        return (
            <div className="min-h-screen flex items-center justify-center">
                <div className="text-center">
                    <h2 className="text-xl font-semibold text-gray-800">Acesso Negado</h2>
                    <p className="text-gray-600 mt-2">A redirecionar...</p>
                </div>
            </div>
        );
    }

    return children;
};
