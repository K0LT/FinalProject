import Navbar from './components/Navbar';
import HeroSection from "@/app/Pages/LandingPage/components/HeroSection";
import StartToday from "@/app/Pages/LandingPage/components/StartToday";
import AboutJM from "@/app/Pages/LandingPage/components/AboutJM";
import WhyQiFlow from "@/app/Pages/LandingPage/components/WhyQiFlow";
import PlansSection from "@/app/Pages/LandingPage/components/PlansSection";



const Page = () => {
    return (
        <div>
            <Navbar />
            <HeroSection />
            <StartToday />
            <AboutJM />
            <WhyQiFlow />
            <PlansSection />

        </div>
    );
};

export default Page;
