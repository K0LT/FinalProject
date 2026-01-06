'use client';

import { AuthGuard} from "@/components/Auth/AuthGuard";

import ChatbotPage from "@/components/assistant/ChatbotPage";

export default function AppointmentsPage() {
    return (
        <AuthGuard>
            <ChatbotPage />;
        </AuthGuard>
    );
}