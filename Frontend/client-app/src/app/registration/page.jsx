import React from 'react';
import RegistrationForm from '@/components/registration/RegistrationForm';
import Benefits from '@/components/registration/Benefits';
import Testimonials from '@/components/registration/Testimonials';
import Help from '@/components/registration/Help';
import RegistrationIntro from "@/components/registration/RegistrationIntro";

import LandingLayout from '@/components/landingPage/LandingLayout'

const Register = () => {
    return <LandingLayout>
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div className="space-y-8">
                <RegistrationIntro />
                <RegistrationForm />
            </div>
            <div className="space-y-8">
                <Benefits />
                <Testimonials />
                <Help />
            </div>
        </div>
    </LandingLayout>


}
export default Register;