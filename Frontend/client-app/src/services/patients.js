import {apiClient} from '@/lib/api';

export async function getPatient(id){
    const response = await apiClient.get('/patients/' + id);
    return response.data;
}

export async function getPatients(){
    const response = await apiClient.get('/patients');
    return response.data;
}

export async function updatePatient(id, patient){
    const response = await apiClient.put('/patients/' + id, patient);
    return response.data;
}