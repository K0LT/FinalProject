import '@/app/tailwind.css'
import Hero from "@/components/landingPage/Hero";
import ReadyToStart from "@/components/landingPage/ReadyToStart";
import StartToday from "@/components/landingPage/StartToday";
import AboutJM from "@/components/landingPage/AboutJM";
import WhyQiFlow from "@/components/landingPage/WhyQiFlow";
import Plans from "@/components/landingPage/Plans";
import Testimonials from "@/components/landingPage/Testimonials";

const Page = () => {
    return (
        <div>
            <Hero />
            <StartToday />
            <AboutJM />
            <WhyQiFlow />
            <Plans />
            <Testimonials />
            <ReadyToStart />
        </div>
    );
};

export default Page;