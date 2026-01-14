/**
 * User Services - Patient-specific API endpoints
 *
 * These endpoints are for logged-in patients to access their own data.
 * All routes are prefixed with /user and require authentication.
 */

import { apiClient } from '@/lib/api';

/**
 * Get current patient's profile information
 */
export const getUserPatient = async () => {
    const response = await apiClient.get('api/user/patient');
    return response.patient;
};

/**
 * Get current patient's appointments
 */
export const getUserAppointments = async () => {
    const response = await apiClient.get('api/user/appointments');
    return response.appointments || [];
};

/**
 * Request a new appointment (status will be 'Pendente')
 * @param {Object} appointmentData - { appointment_date_time, notes }
 */
export const requestAppointment = async (appointmentData) => {
    const response = await apiClient.post('api/user/appointments/create', appointmentData);
    return response;
};

/**
 * Get current patient's allergies
 */
export const getUserAllergies = async () => {
    const response = await apiClient.get('/api/user/allergies');
    return response.allergies || [];
};

/**
 * Add an allergy to current patient
 * @param {Object} allergyData - { allergy_id }
 */
export const addUserAllergy = async (allergyData) => {
    const response = await apiClient.post('/api/user/allergies/add', allergyData);
    return response;
};

/**
 * Remove an allergy from current patient
 * @param {Object} allergyData - { allergy_id }
 */
export const removeUserAllergy = async (allergyData) => {
    const response = await apiClient.post('/api/user/allergies/remove', allergyData);
    return response;
};

/**
 * Get current patient's conditions
 */
export const getUserConditions = async () => {
    const response = await apiClient.get('/api/user/conditions');
    return response.conditions || [];
};

/**
 * Get current patient's daily nutrition records
 */
export const getUserDailyNutritions = async () => {
    const response = await apiClient.get('/api/user/daily_nutritions');
    return response.dailyNutritions || [];
};

/**
 * Get current patient's diagnostics (includes symptoms)
 */
export const getUserDiagnostics = async () => {
    const response = await apiClient.get('/api/user/diagnostics');
    return response.diagnostics || [];
};

/**
 * Get current patient's exercises
 */
export const getUserExercises = async () => {
    const response = await apiClient.get('/api/user/exercises');
    return response.exercises || [];
};

/**
 * Add an exercise to current patient
 * @param {Object} exerciseData - { exercise_id, prescribed_date, frequency, notes }
 */
export const addUserExercise = async (exerciseData) => {
    const response = await apiClient.post('/api/user/exercises/add', exerciseData);
    return response;
};

/**
 * Remove an exercise from current patient
 * @param {Object} exerciseData - { exercise_id }
 */
export const removeUserExercise = async (exerciseData) => {
    const response = await apiClient.post('/api/user/exercises/remove', exerciseData);
    return response;
};

/**
 * Get current patient's treatment goals (includes milestones)
 */
export const getUserTreatmentGoals = async () => {
    const response = await apiClient.get('/api/user/treatment_goals');
    return response.treatments || [];
};

/**
 * Get current patient's nutritional goals
 */
export const getUserNutritionalGoals = async () => {
    const response = await apiClient.get('/api/user/nutritional_goals');
    return response.nutritionalGoals || [];
};

/**
 * Get current patient's treatments
 */
export const getUserTreatments = async () => {
    const response = await apiClient.get('/api/user/treatments');
    return response.treatments || [];
};

/**
 * Get current patient's weight tracking records
 */
export const getUserWeightTrackings = async () => {
    const response = await apiClient.get('/api/user/weight_trackings');
    return response.weightTrackings || [];
};
