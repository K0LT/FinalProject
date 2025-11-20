import {api} from "@/lib/api"
import {setAuthToken} from "@/lib/api";

export const login = async (user) => {
    const response = await api.post('/login', user);
    setAuthToken(response.data.token);
    return response.data;
}