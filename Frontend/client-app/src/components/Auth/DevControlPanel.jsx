'use client';

import { useEffect, useState } from 'react';

export default function DevControlPanel() {
    const [isMounted, setIsMounted] = useState(false);
    const [devMode, setDevMode] = useState(false);
    const [authState, setAuthState] = useState({
        isAuthenticated: false,
        user: null
    });

    useEffect(() => {
        setIsMounted(true);


        const savedMode = localStorage.getItem('dev_auto_login') === 'true';
        setDevMode(savedMode);


        const userData = localStorage.getItem('user_data');
        const user = userData ? JSON.parse(userData) : null;
        const token = localStorage.getItem('auth_token');

        setAuthState({
            isAuthenticated: !!(token && user),
            user
        });
    }, []);

    const toggleDevMode = () => {
        const newMode = !devMode;
        setDevMode(newMode);
        localStorage.setItem('dev_auto_login', newMode.toString());
        window.location.reload();
    };


    if (!isMounted || process.env.NODE_ENV !== 'development') {
        return null;
    }

    return (
        <div className="fixed bottom-4 left-4 z-50 bg-gray-800 text-white p-3 rounded-lg shadow-lg border border-gray-600">
            <div className="flex items-center gap-3 mb-2">
                <span className="text-sm font-bold">🔧 Dev Auth</span>
                <button
                    onClick={toggleDevMode}
                    className={`px-3 py-1 rounded text-xs font-medium ${
                        devMode ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'
                    } transition-colors`}
                >
                    {devMode ? 'ON' : 'OFF'}
                </button>
            </div>

            <div className="text-xs space-y-1">
                <div className="flex justify-between">
                    <span>Estado:</span>
                    <span className={authState.isAuthenticated ? "text-green-400" : "text-red-400"}>
            {authState.isAuthenticated ? 'Autenticado' : 'Não autenticado'}
          </span>
                </div>
                <div className="flex justify-between">
                    <span>Modo:</span>
                    <span className={devMode ? "text-yellow-400" : "text-blue-400"}>
            {devMode ? 'Mock Data' : 'API Real'}
          </span>
                </div>
                <div className="flex justify-between">
                    <span>User:</span>
                    <span>{authState.user?.name || 'Nenhum'}</span>
                </div>
            </div>

            {devMode && (
                <div className="mt-2 p-2 bg-yellow-600 rounded text-xs">
                    Dados Mock - API Desativada
                </div>
            )}
        </div>
    );
}