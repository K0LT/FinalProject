import AppLayout from "@/components/layout/AppLayout";
import ClientProfilePage from "@/components/client/ClientProfilePage";
export default function Page(){
    return <AppLayout children={<ClientProfilePage/>}/>
};