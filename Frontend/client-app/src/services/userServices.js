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
    const response = await apiClient.get('/user/patient');
    return response.data;
};

/**
 * Get current patient's appointments
 */
export const getUserAppointments = async () => {
    const response = await apiClient.get('/user/appointments');
    return response.data;
};

/**
 * Request a new appointment (status will be 'Pendente')
 * @param {Object} appointmentData - { appointment_date_time, notes }
 */
export const requestAppointment = async (appointmentData) => {
    const response = await apiClient.post('/user/appointments/create', appointmentData);
    return response.data;
};

/**
 * Get current patient's allergies
 */
export const getUserAllergies = async () => {
    const response = await apiClient.get('/user/allergies');
    return response.data;
};

/**
 * Add an allergy to current patient
 * @param {Object} allergyData - { allergy_id }
 */
export const addUserAllergy = async (allergyData) => {
    const response = await apiClient.post('/user/allergies/add', allergyData);
    return response.data;
};

/**
 * Remove an allergy from current patient
 * @param {Object} allergyData - { allergy_id }
 */
export const removeUserAllergy = async (allergyData) => {
    const response = await apiClient.post('/user/allergies/remove', allergyData);
    return response.data;
};

/**
 * Get current patient's conditions
 */
export const getUserConditions = async () => {
    const response = await apiClient.get('/user/conditions');
    return response.data;
};

/**
 * Get current patient's daily nutrition records
 */
export const getUserDailyNutritions = async () => {
    const response = await apiClient.get('/user/daily_nutritions');
    return response.data;
};

/**
 * Get current patient's diagnostics (includes symptoms)
 */
export const getUserDiagnostics = async () => {
    const response = await apiClient.get('/user/diagnostics');
    return response.data;
};

/**
 * Get current patient's exercises
 */
export const getUserExercises = async () => {
    const response = await apiClient.get('/user/exercises');
    return response.data;
};

/**
 * Add an exercise to current patient
 * @param {Object} exerciseData - { exercise_id, prescribed_date, frequency, notes }
 */
export const addUserExercise = async (exerciseData) => {
    const response = await apiClient.post('/user/exercises/add', exerciseData);
    return response.data;
};

/**
 * Remove an exercise from current patient
 * @param {Object} exerciseData - { exercise_id }
 */
export const removeUserExercise = async (exerciseData) => {
    const response = await apiClient.post('/user/exercises/remove', exerciseData);
    return response.data;
};

/**
 * Get current patient's treatment goals (includes milestones)
 */
export const getUserTreatmentGoals = async () => {
    const response = await apiClient.get('/user/treatment_goals');
    return response.data;
};

/**
 * Get current patient's nutritional goals
 */
export const getUserNutritionalGoals = async () => {
    const response = await apiClient.get('/user/nutritional_goals');
    return response.data;
};

/**
 * Get current patient's treatments
 */
export const getUserTreatments = async () => {
    const response = await apiClient.get('/user/treatments');
    return response.data;
};

/**
 * Get current patient's weight tracking records
 */
export const getUserWeightTrackings = async () => {
    const response = await apiClient.get('/user/weight_trackings');
    return response.data;
};
