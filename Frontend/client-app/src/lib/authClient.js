const API_BASE =
    process.env.NEXT_PUBLIC_API_BASE ?? "http://localhost:8000/api";

const ROOT = API_BASE.replace(/\/api\/?$/, "");

function getCookie(name) {
    if (typeof document === "undefined") return null;
    const match = document.cookie.match(
        new RegExp("(^|; )" + name + "=([^;]*)"),
    );
    return match ? decodeURIComponent(match[2]) : null;
}

async function ensureCsrf() {
    if (typeof window === "undefined") return;

    const xsrf = getCookie("XSRF-TOKEN");
    if (xsrf) return;

    await fetch(`${ROOT}/sanctum/csrf-cookie`, {
        method: "GET",
        credentials: "include",
    });
}

export async function postJson(path, body, options = {}) {
    await ensureCsrf();

    const xsrf = getCookie("XSRF-TOKEN");

    const headers = {
        "Content-Type": "application/json",
        Accept: "application/json",
        ...(options.headers || {}),
    };

    if (xsrf) {
        headers["X-XSRF-TOKEN"] = xsrf;
    }

    const res = await fetch(`${API_BASE}${path}`, {
        method: "POST",
        headers,
        credentials: "include",
        body: JSON.stringify(body),
    });

    let data = null;
    try {
        data = await res.json();
    } catch {
    }

    if (!res.ok) {
        const message =
            (data && (data.message || data.error)) ||
            `Erro ao comunicar com o servidor (${res.status})`;
        const error = new Error(message);
        error.status = res.status;
        error.data = data;
        throw error;
    }

    if (data && data.token && typeof document !== "undefined") {
        document.cookie =
            "auth-token=" +
            encodeURIComponent(data.token) +
            "; path=/; max-age=" +
            60 * 60 * 24 * 7 +
            "; SameSite=Lax";
    }

    return data;
}


export async function register(payload) {
    return postJson("/register", payload);
}

export async function login(payload) {
    const data = await postJson("/login", payload);
    if (typeof document !== "undefined") {
        document.cookie =
            "auth-token=session; path=/; max-age=" +
            60 * 60 * 24 * 7 +
            "; SameSite=Lax";
    }

    return data;
}
export async function logout() {
    await postJson("/logout", {});

    if (typeof document !== "undefined") {
        document.cookie =
            "auth-token=; path=/; max-age=0; SameSite=Lax";
    }
}

