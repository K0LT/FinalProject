import {api} from "@/lib/api";

export async function getSymptoms(){
    const response = await api.get('/symptoms');
    return response.data;
}