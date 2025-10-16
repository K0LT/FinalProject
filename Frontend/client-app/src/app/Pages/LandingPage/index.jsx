import "../LandingPage/index.css";
import Header from "../Master/Header";
import Footer from "../Master/Footer";

import Hero from "./components/Hero";
import HowItWorks from "./components/HowItWorks";
import Features from "./components/Features";
import FinalCta from "./components/FinalCta";

export default function LandingPage() {
    return (
        <>
            <Header />

            <Hero />
            <HowItWorks />
            <Features />
            <FinalCta />

            <Footer />
        </>
    );
}
