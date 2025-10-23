import {api} from '@/lib/api';

export async function getClient(id){
    const response = await api.get('/clients/' + id);
    return response.data;
}

export async function getClients(){
    const response = await api.get('/clients');
    return response.data;
}

// temporarily keeping above for compatibility

export async function getPatient(id){
    const response = await api.get('/patients/' + id);
    return response.data;
}

export async function getPatients(){
    const response = await api.get('/patients');
    return response.data;
}