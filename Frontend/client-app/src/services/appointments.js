import {api} from '@/lib/api';

const USE_MOCK = true;

const MOCK_APPOINTMENTS = [
    {
        id: 1,
        patient_name: "Inez Borges",
        appointment_date: "2024-12-20T14:00:00",
        duration: 60,
        status: "confirmed",
        notes: "Consulta inicial"
    },
    // ... more mock data
];

const MOCK_SLOTS = [
    { time: "09:00", available: true },
    { time: "10:00", available: true },
    { time: "11:00", available: false },
    { time: "13:00", available: true },
    { time: "14:00", available: true },
    { time: "15:00", available: true },
    { time: "16:00", available: true },
    { time: "17:00", available: true },
];

export async function getUpcomingAppointments() {
    if (USE_MOCK) {
        await new Promise(resolve => setTimeout(resolve, 1000)); // Simulate delay
        return MOCK_APPOINTMENTS;
    }

    const response = await api.get('/appointments');
    return response.data;
}

export async function getAvailableSlots(date) {
    if (USE_MOCK) {
        await new Promise(resolve => setTimeout(resolve, 500));
        return MOCK_SLOTS;
    }

    const dateStr = date.toISOString().split('T')[0];
    const response = await api.get('/appointments/available-slots', {
        params: { date: dateStr }
    });
    return response.data;
}

export async function getAppointments() {
    const response = await api.get('/appointments');
    return response.data;
}

export async function getAppointment(id) {
    const response = await api.get(`/appointments/${id}`);
    return response.data;
}

export async function createAppointment(data) {
    const response = await api.post('/appointments', data);
    return response.data;
}

export async function updateAppointment(id, data) {
    const response = await api.put(`/appointments/${id}`, data);
    return response.data;
}

export async function deleteAppointment(id) {
    const response = await api.delete(`/appointments/${id}`);
    return response.data;
}

export async function getAppointmentsByPatient(patientId) {
    const response = await api.get(`/appointments`, {
        params: { patient_id: patientId }
    });
    return response.data;
}


//export async function getUpcomingAppointments() {
  //  const today = new Date().toISOString().split('T')[0];
    //const response = await api.get('/appointments', {
      //  params: {
        //    start_date: today,
          //  status: 'scheduled,confirmed'
        //}
    //});
    //return response.data;

//}