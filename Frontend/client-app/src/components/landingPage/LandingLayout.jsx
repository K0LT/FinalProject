import Navbar from "@/components/landingPage/Navbar";
import Footer from "@/components/landingPage/Footer"
import '@/app/tailwind.css'

export default function LandingLayout({ children }) {
    return (
        <>
            {<Navbar />}
            {children}
            {<Footer />}
        </>
    );
}
