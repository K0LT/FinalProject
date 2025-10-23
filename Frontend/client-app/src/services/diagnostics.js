import {api} from "@/lib/api";

export async function getDiagnostic(id){
    const response = await api.get('/diagnostics/' + id);
    return response.data;
}

export async function getDiagnostics(){
    const response = await api.get('/diagnostics');
    return response.data;
}