import LandingPage from "@/app/landingPage/page";
import {AuthGuard} from "@/components/Auth/AuthGuard";


export default function Home() {
    return (
        <AuthGuard>
        <LandingPage />;
        </AuthGuard>
    );

}

