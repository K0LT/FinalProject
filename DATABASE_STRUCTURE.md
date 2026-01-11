# Database Structure & Relationships

## Core Tables

### Users & Patients
- **users** - All system users (admin, patients, etc.)
  - `role_id` - Links to roles table (1=Admin, 3=Patient)
  - `name`, `surname`, `email`, `password`

- **patients** - Patient-specific data (one-to-one with users)
  - `user_id` - Foreign key to users
  - `phone_number`, `address`, `gender`, `birth_date`
  - `emergency_contact_name`, `emergency_contact_phone`, `emergency_contact_relation`
  - `client_since`, `last_visit`, `next_appointment`

### Appointments
- **appointments** - Patient appointments
  - `patient_id` - Foreign key to patients
  - `appointment_date_time` - Date and time of appointment
  - `type`, `notes`, `status` (Pendente, Confirmado, Cancelado, Concluído)
  - `duration`

### Diagnostics & Treatments
- **diagnostics** - Patient diagnoses
  - `patient_id` - Foreign key to patients
  - `diagnostic_date` - Date of diagnosis
  - `western_diagnosis` - Western medicine diagnosis
  - `tcm_diagnosis` - Traditional Chinese Medicine diagnosis
  - `severity`, `pulse_quality`, `tongue_description`

- **diagnostic_symptom** - Many-to-many junction table
  - `diagnostic_id` - Foreign key to diagnostics
  - `symptom_id` - Foreign key to symptoms

- **symptoms** - System-wide symptoms
  - `name`, `description`

- **treatments** - Treatment sessions for diagnostics
  - `diagnostic_id` - Foreign key to diagnostics
  - `patient_id` - Foreign key to patients
  - `session_date_time` - When treatment was/will be done
  - `treatment_methods`, `acupoints_used`, `duration`
  - `notes`, `next_session`

### Conditions
- **conditions** - Patient's medical conditions
  - `patient_id` - Foreign key to patients
  - `name` - Condition name
  - `diagnosed_date`, `status`

### Treatment Goals & Milestones
- **treatment_goals** - Patient's treatment objectives
  - `patient_id` - Foreign key to patients
  - `title`, `description`
  - `priority` (Mínima, Média, Alta)
  - `status` (Em progresso, Concluído, Cancelado)
  - `progress_percentage` - Calculated from completed milestones
  - `target_date`, `treatment_methods`

- **goal_milestones** - Milestones for treatment goals
  - `treatment_goal_id` - Foreign key to treatment_goals
  - `milestone_description`, `milestone_date`
  - `completed` - Boolean flag

### Exercises
- **exercises** - System-wide exercises
  - `name`, `description`, `instructions`

- **exercise_patient** - Many-to-many junction table (pivot)
  - `patient_id`, `exercise_id`
  - `prescribed_date` - When exercise was prescribed
  - `frequency`, `status`
  - `compliance_rate` - Percentage of compliance
  - `last_performed` - Last date exercise was done
  - `actual_number` - How many times patient has done it
  - `target_number` - How many times patient should do it
  - `notes`

### Weight & Nutrition
- **weight_trackings** - Patient weight records
  - `patient_id` - Foreign key to patients
  - `weight` - Weight in kg
  - `notes`

- **nutritional_goals** - Patient's nutrition targets
  - `patient_id` - Foreign key to patients
  - `daily_calories`, `daily_protein`, `daily_carbs`, `daily_fat`
  - `notes`

- **daily_nutrition** - Daily nutrition records
  - `patient_id` - Foreign key to patients
  - `nutrition_date` - Date of record
  - `calories`, `protein`, `carbohydrates`, `fat`
  - `notes`

### Progress & Allergies
- **progress_notes** - Patient progress notes
  - `patient_id` - Foreign key to patients
  - `note_title`, `note_content`
  - `note_date` - Date of note

- **allergies** - System-wide allergies
  - `allergen` - Allergy name
  - `description`

- **allergy_patient** - Many-to-many junction table
  - `patient_id`, `allergy_id`

## Key Relationships

### Patient has many:
- appointments
- diagnostics
- treatments
- conditions
- treatment_goals
- weight_trackings
- nutritional_goals
- daily_nutrition
- progress_notes

### Patient has many-to-many:
- exercises (through exercise_patient pivot)
- allergies (through allergy_patient pivot)

### Diagnostic has many:
- treatments
- symptoms (through diagnostic_symptom)

### Treatment Goal has many:
- goal_milestones

## Important Notes

1. **Diagnostics** don't have a direct relationship to Conditions. They store `western_diagnosis` and `tcm_diagnosis` as text fields.

2. **Symptoms** are linked to Diagnostics through a many-to-many relationship via `diagnostic_symptom` table.

3. **Treatments** are linked to Diagnostics and represent treatment sessions for a specific diagnosis.

4. **Exercise tracking** uses a pivot table with `actual_number` and `target_number` to track compliance.

5. **Treatment Goals** progress is calculated from the count of completed milestones.

6. **Allergies** are system-wide and linked to patients through a many-to-many relationship.
