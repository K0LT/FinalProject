import { NextResponse } from "next/server";

export function middleware(req) {
    const token = req.cookies.get('auth-token');

    if (!token) {
        return NextResponse.redirect(new URL("/login", req.url));
    }

    return NextResponse.next();
}

export const config = {
    matcher: ["/appointments/:path*", "/clientProfile/:path*", "/diagnoses/:path*"],
};
