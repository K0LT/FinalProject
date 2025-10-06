import {api} from '@/lib/api';

export async function getClient(id){
    const response = await api.get('/clients/' + id);
    return response.data;
}


//