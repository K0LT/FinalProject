/**
 * Role-based routing and authorization helpers
 */

// Role IDs from database (see RoleSeeder.php)
export const ROLES = {
    ADMIN: 1,
    FUNCIONARIO: 2,
    PATIENT: 3,
};

/**
 * Get the default dashboard route for a user based on their role
 * @param {Object} user - User object with role_id
 * @returns {string} - Dashboard route
 */
export function getDashboardRoute(user) {
    if (!user || !user.role_id) {
        return '/login';
    }

    switch (user.role_id) {
        case ROLES.ADMIN:
        case ROLES.FUNCIONARIO:
            return '/dashboard';
        case ROLES.PATIENT:
            return '/clientdashboard';
        default:
            return '/login';
    }
}

/**
 * Check if user is admin
 * @param {Object} user - User object with role_id
 * @returns {boolean}
 */
export function isAdmin(user) {
    return user?.role_id === ROLES.ADMIN;
}

/**
 * Check if user is staff (Funcionario)
 * @param {Object} user - User object with role_id
 * @returns {boolean}
 */
export function isStaff(user) {
    return user?.role_id === ROLES.FUNCIONARIO;
}

/**
 * Check if user is patient
 * @param {Object} user - User object with role_id
 * @returns {boolean}
 */
export function isPatient(user) {
    return user?.role_id === ROLES.PATIENT;
}

/**
 * Check if user can access staff/admin dashboard
 * @param {Object} user - User object with role_id
 * @returns {boolean}
 */
export function canAccessStaffDashboard(user) {
    return isAdmin(user) || isStaff(user);
}

/**
 * Get user's role name
 * @param {Object} user - User object with role_id
 * @returns {string}
 */
export function getRoleName(user) {
    if (!user || !user.role_id) return 'Unknown';

    switch (user.role_id) {
        case ROLES.ADMIN:
            return 'Admin';
        case ROLES.FUNCIONARIO:
            return 'Funcionário';
        case ROLES.PATIENT:
            return 'Paciente';
        default:
            return 'Unknown';
    }
}
