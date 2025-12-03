import {api} from "@/lib/api";

export async function getTreatment(id){
    const response = await api.get('/treatments/' + id);
    return response.data;
}

export async function getTreatments(id){
    const response = await api.get('/patients/' + id + '/treatments');
    return response.data;
}

export async function postTreatment(treatment){
    const response = await api.post('/treatments', treatment);
    return response.data;
}