import { apiClient } from "@/lib/api";

export async function getTreatment(id){
    const response = await apiClient.get('/treatments/' + id);
    return response?.data || response;
}

export async function getTreatments(patientId){
    const response = await apiClient.get('/api/patients/' + patientId + '/treatments');
    return response?.treatments || response?.data || response || [];
}

export async function postTreatment(treatment){
    const response = await apiClient.post('/treatments', treatment);
    return response;
}