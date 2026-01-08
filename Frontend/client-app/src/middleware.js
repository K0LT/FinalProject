import { NextResponse } from "next/server";

/**
 * Minimal middleware for protected routes
 *
 * Since middleware runs server-side and cannot access localStorage,
 * we rely on the client-side AuthGuard component for actual auth checks.
 * This middleware just ensures the routes are properly configured.
 */
export function middleware(req) {
    // Pass through - AuthGuard handles authentication on client-side
    return NextResponse.next();
}

export const config = {
    matcher: [
        "/dashboard/:path*",
        "/appointments/:path*",
        "/clientProfile/:path*",
        "/diagnoses/:path*"
    ],
};
