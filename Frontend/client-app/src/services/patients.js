import {api} from '@/lib/api';

export async function getPatient(id){
    const response = await api.get('/patients/' + id);
    return response.data;
}

export async function getPatients(){
    const response = await api.get('/patients');
    return response.data;
}

export async function updatePatient(id, patient){
    const response = await api.put('/patients/' + id, patient);
    return response.data;
}