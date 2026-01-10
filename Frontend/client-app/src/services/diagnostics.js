import { apiClient } from "@/lib/api";

export async function getDiagnostic(patientId){
    const response = await apiClient.get('/api/' + patientId + '/diagnostics/');
    return response?.data || response;
}

export async function getDiagnostics(patientId){
    const response = await apiClient.get('/api/patients/' + patientId + '/diagnostics');
    return response?.diagnostics || response?.data || response || [];
}

export async function postDiagnostic(diagnostic) {
    const response = await apiClient.post('/api/diagnostics', diagnostic);
    return response;
}