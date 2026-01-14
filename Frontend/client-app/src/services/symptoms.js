import {apiClient} from "@/lib/api";

export async function getSymptoms(){
    const response = await apiClient.get('/symptoms');
    return response.data;
}