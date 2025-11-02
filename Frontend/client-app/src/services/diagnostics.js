import {api} from "@/lib/api";

export async function getDiagnostic(id){
    const response = await api.get('/diagnostics/' + id);
    return response.data;
}

export async function getDiagnostics(id){
    const response = await api.get('/patients/' + id + '/diagnostics');
    return response.data;
}