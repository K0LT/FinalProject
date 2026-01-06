'use client';

import { useState, createContext, useContext } from 'react';
import { Plus, CircleCheckBig, Dumbbell, CircleAlert, Clock, Target, Play } from 'lucide-react';

// Context para Tabs
const TabsContext = createContext();

// Componente Button
function Button({ children, onClick, className = '', variant = 'primary', ...props }) {
    const baseClass = 'inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] h-8 rounded-md gap-1.5 px-3';

    const variants = {
        primary: 'bg-primary text-primary-foreground hover:bg-primary/90',
        secondary: 'border bg-background text-foreground hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50',
    };

    return (
        <button
            onClick={onClick}
            className={`${baseClass} ${variants[variant]} ${className}`}
            {...props}
        >
            {children}
        </button>
    );
}

// Componente Badge
function Badge({ children, variant = 'default' }) {
    const variants = {
        default: 'border-transparent bg-secondary text-secondary-foreground',
        primary: 'border-transparent bg-primary text-primary-foreground',
        outline: 'text-foreground hover:bg-accent hover:text-accent-foreground',
        destructive: 'border-transparent bg-destructive text-white dark:bg-destructive/60',
    };

    return (
        <span className={`inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap ${variants[variant]}`}>
      {children}
    </span>
    );
}

// Componente Tabs
function Tabs({ children, activeTab, onTabChange }) {
    return (
        <TabsContext.Provider value={{ activeTab, onTabChange }}>
            <div className="flex flex-col gap-2 space-y-4">{children}</div>
        </TabsContext.Provider>
    );
}

function TabsList({ children }) {
    return (
        <div
            role="tablist"
            className="bg-muted text-muted-foreground h-9 w-fit items-center justify-center rounded-xl p-[3px] flex"
        >
            {children}
        </div>
    );
}

function TabsTrigger({ value, children }) {
    const { activeTab, onTabChange } = useContext(TabsContext);
    const isActive = activeTab === value;

    return (
        <button
            type="button"
            role="tab"
            aria-selected={isActive}
            onClick={() => onTabChange(value)}
            className={`${
                isActive
                    ? 'bg-card text-foreground dark:border-input dark:bg-input/30'
                    : 'text-foreground dark:text-muted-foreground'
            } inline-flex h-[calc(100%-1px)] flex-1 items-center justify-center gap-1.5 rounded-xl border border-transparent px-2 py-1 text-sm font-medium whitespace-nowrap transition-[color,box-shadow] focus-visible:ring-[3px] focus-visible:outline-1 disabled:pointer-events-none disabled:opacity-50`}
        >
            {children}
        </button>
    );
}

function TabsContent({ value, children }) {
    const { activeTab } = useContext(TabsContext);

    if (activeTab !== value) return null;

    return (
        <div role="tabpanel" className="flex-1 outline-none space-y-4">
            {children}
        </div>
    );
}

Tabs.List = TabsList;
Tabs.Trigger = TabsTrigger;
Tabs.Content = TabsContent;

// Componentes Card
function Card({ children, className = '' }) {
    return (
        <div className={`bg-card text-card-foreground flex flex-col gap-6 rounded-xl border ${className}`}>
            {children}
        </div>
    );
}

function CardHeader({ children }) {
    return (
        <div className="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6">
            {children}
        </div>
    );
}

function CardTitle({ children }) {
    return <h4 className="leading-none font-semibold">{children}</h4>;
}

function CardDescription({ children }) {
    return <p className="text-muted-foreground text-sm">{children}</p>;
}

function CardContent({ children }) {
    return <div className="px-6 pb-6">{children}</div>;
}

// Componente Checkbox
function Checkbox({ id, checked, onChange }) {
    return (
        <button
            type="button"
            role="checkbox"
            aria-checked={checked}
            onClick={() => onChange(!checked)}
            className={`peer ${
                checked
                    ? 'bg-primary text-primary-foreground border-primary'
                    : 'bg-input-background dark:bg-input/30'
            } size-4 shrink-0 rounded-[4px] border shadow-xs transition-shadow outline-none focus-visible:ring-[3px] focus-visible:border-ring focus-visible:ring-ring/50 flex items-center justify-center`}
            id={id}
        >
            {checked && (
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    className="w-3 h-3"
                >
                    <polyline points="20 6 9 17 4 12" />
                </svg>
            )}
        </button>
    );
}

// Componente ExerciseLibrary
function ExerciseLibrary() {
    const exercises = [
        {
            id: 1,
            title: 'Lower Back Stretch Sequence',
            description: 'Gentle stretches to relieve lower back tension and improve flexibility',
            level: 'Beginner',
            status: 'Active',
            lastCompleted: '2024-09-15',
            duration: '10-15 minutes',
            frequency: 'Daily',
            category: 'Stretching',
            compliance: 85,
            instructions: [
                'Start lying on your back with knees bent',
                'Bring one knee to chest, hold for 30 seconds',
                'Repeat with other leg',
                'Bring both knees to chest, rock gently side to side',
                "End with child's pose for 1 minute",
            ],
            benefits: ['Reduces back stiffness', 'Improves flexibility', 'Relieves tension'],
            precautions: ['Stop if pain increases', 'Move slowly and gently'],
        },
        {
            id: 2,
            title: 'Stress Relief Breathing',
            description: 'Deep breathing exercise to activate parasympathetic nervous system',
            level: 'Beginner',
            status: 'Active',
            lastCompleted: '2024-09-16',
            duration: '5-10 minutes',
            frequency: '2-3 times daily',
            category: 'Breathing',
            compliance: 92,
            instructions: [
                'Sit comfortably with spine straight',
                'Inhale through nose for 4 counts',
                'Hold breath for 4 counts',
                'Exhale through mouth for 6 counts',
                'Repeat for 10-15 cycles',
            ],
            benefits: ['Reduces stress', 'Lowers heart rate', 'Improves focus'],
            precautions: ["Don't strain", 'Stop if dizzy'],
        },
        {
            id: 3,
            title: 'Core Strengthening Routine',
            description: 'Gentle core exercises to support lower back stability',
            level: 'Intermediate',
            status: 'Pending',
            lastCompleted: null,
            duration: '15-20 minutes',
            frequency: '3 times per week',
            category: 'Strength',
            compliance: 0,
            instructions: [
                'Start with dead bug exercise - 10 reps each side',
                'Modified plank hold - 30 seconds',
                'Bird dog exercise - 10 reps each side',
                'Glute bridge - 15 reps',
                'Side-lying leg lifts - 10 reps each side',
            ],
            benefits: ['Strengthens core', 'Improves stability', 'Supports back health'],
            precautions: ['Maintain proper form', 'Progress gradually'],
        },
    ];

    return (
        <div className="space-y-4">
            {exercises.map((exercise) => (
                <Card key={exercise.id}>
                    <CardHeader>
                        <div className="flex items-start justify-between">
                            <div className="space-y-2">
                                <CardTitle>
                                    <div className="flex items-center gap-2">
                                        <Dumbbell className="w-5 h-5" />
                                        {exercise.title}
                                    </div>
                                </CardTitle>
                                <CardDescription>{exercise.description}</CardDescription>
                            </div>
                            <div className="flex flex-col items-end gap-2">
                                <div className="flex gap-2">
                                    <Badge variant={exercise.level === 'Intermediate' ? 'primary' : 'default'}>
                                        {exercise.level}
                                    </Badge>
                                    <Badge variant={exercise.status === 'Active' ? 'primary' : 'default'}>
                                        {exercise.status}
                                    </Badge>
                                </div>
                                {exercise.lastCompleted && (
                                    <div className="text-sm text-muted-foreground">
                                        <span>Last: {exercise.lastCompleted}</span>
                                    </div>
                                )}
                            </div>
                        </div>
                    </CardHeader>
                    <CardContent>
                        <div className="space-y-4">
                            <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div>
                                    <p className="text-muted-foreground">Duration</p>
                                    <p>{exercise.duration}</p>
                                </div>
                                <div>
                                    <p className="text-muted-foreground">Frequency</p>
                                    <p>{exercise.frequency}</p>
                                </div>
                                <div>
                                    <p className="text-muted-foreground">Category</p>
                                    <p>{exercise.category}</p>
                                </div>
                                <div>
                                    <p className="text-muted-foreground">Compliance</p>
                                    <p className={exercise.compliance >= 50 ? 'text-green-600' : 'text-red-600'}>
                                        {exercise.compliance}%
                                    </p>
                                </div>
                            </div>

                            <div>
                                <h4 className="text-sm mb-2 font-medium">Instructions</h4>
                                <ol className="text-sm space-y-1 text-muted-foreground ml-4">
                                    {exercise.instructions.map((instruction, idx) => (
                                        <li key={idx} className="list-decimal">
                                            {instruction}
                                        </li>
                                    ))}
                                </ol>
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 className="text-sm mb-2 font-medium">Benefits</h4>
                                    <div className="flex flex-wrap gap-1">
                                        {exercise.benefits.map((benefit, idx) => (
                                            <Badge key={idx} variant="outline">
                                                {benefit}
                                            </Badge>
                                        ))}
                                    </div>
                                </div>
                                <div>
                                    <h4 className="text-sm mb-2 font-medium">Precautions</h4>
                                    <div className="flex flex-wrap gap-1">
                                        {exercise.precautions.map((precaution, idx) => (
                                            <Badge key={idx} variant="destructive">
                                                {precaution}
                                            </Badge>
                                        ))}
                                    </div>
                                </div>
                            </div>

                            <div className="flex gap-2 pt-4 border-t">
                                <Button>
                                    <Play className="w-4 h-4 mr-2" />
                                    Start Exercise
                                </Button>
                                <Button variant="secondary">Mark Complete</Button>
                                <Button variant="secondary">Edit Exercise</Button>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            ))}
        </div>
    );
}

// Componente WorkoutPlans
function WorkoutPlans() {
    const [plans, setPlans] = useState([
        {
            id: 1,
            title: 'Morning Routine',
            duration: '20 minutes',
            bestTime: '7:00 AM',
            exercises: [
                { id: 1, name: 'Lower Back Stretch Sequence', completed: false },
                { id: 2, name: 'Stress Relief Breathing', completed: false },
            ],
        },
        {
            id: 2,
            title: 'Midday Reset',
            duration: '5 minutes',
            bestTime: '12:00 PM',
            exercises: [{ id: 1, name: 'Stress Relief Breathing', completed: false }],
        },
        {
            id: 3,
            title: 'Evening Wellness',
            duration: '30 minutes',
            bestTime: '6:00 PM',
            exercises: [
                { id: 1, name: 'Core Strengthening Routine', completed: false },
                { id: 2, name: 'Lower Back Stretch Sequence', completed: false },
            ],
        },
    ]);

    const handleExerciseToggle = (planId, exerciseId) => {
        setPlans((prevPlans) =>
            prevPlans.map((plan) =>
                plan.id === planId
                    ? {
                        ...plan,
                        exercises: plan.exercises.map((exercise) =>
                            exercise.id === exerciseId
                                ? { ...exercise, completed: !exercise.completed }
                                : exercise
                        ),
                    }
                    : plan
            )
        );
    };

    return (
        <div className="space-y-4">
            {plans.map((plan) => (
                <Card key={plan.id}>
                    <CardHeader>
                        <div className="flex items-start justify-between">
                            <div>
                                <CardTitle>
                                    <div className="flex items-center gap-2">
                                        <Target className="w-5 h-5" />
                                        {plan.title}
                                    </div>
                                </CardTitle>
                                <CardDescription>
                                    <div className="flex items-center gap-4 mt-2">
                    <span className="flex items-center gap-1">
                      <Clock className="w-4 h-4" />
                        {plan.duration}
                    </span>
                                        <span>Best time: {plan.bestTime}</span>
                                    </div>
                                </CardDescription>
                            </div>
                            <Button>
                                <Play className="w-4 h-4 mr-2" />
                                Start Plan
                            </Button>
                        </div>
                    </CardHeader>
                    <CardContent>
                        <div className="space-y-2">
                            <h4 className="text-sm font-medium">Included Exercises</h4>
                            <div className="space-y-2">
                                {plan.exercises.map((exercise) => (
                                    <div key={exercise.id} className="flex items-center gap-2">
                                        <Checkbox
                                            id={`plan-${plan.id}-exercise-${exercise.id}`}
                                            checked={exercise.completed}
                                            onChange={(checked) => handleExerciseToggle(plan.id, exercise.id)}
                                        />
                                        <label
                                            htmlFor={`plan-${plan.id}-exercise-${exercise.id}`}
                                            className="text-sm cursor-pointer"
                                        >
                                            {exercise.name}
                                        </label>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </CardContent>
                </Card>
            ))}
        </div>
    );
}

// Componente StatsCards
function StatsCards() {
    return (
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <Card>
                <CardContent>
                    <div className="flex items-center justify-between pt-6">
                        <div>
                            <p className="text-2xl font-bold">89%</p>
                            <p className="text-sm text-muted-foreground">Overall Compliance</p>
                        </div>
                        <CircleCheckBig className="w-8 h-8 text-green-500" />
                    </div>
                </CardContent>
            </Card>

            <Card>
                <CardContent>
                    <div className="flex items-center justify-between pt-6">
                        <div>
                            <p className="text-2xl font-bold">2</p>
                            <p className="text-sm text-muted-foreground">Active Exercises</p>
                        </div>
                        <Dumbbell className="w-8 h-8 text-muted-foreground" />
                    </div>
                </CardContent>
            </Card>

            <Card>
                <CardContent>
                    <div className="flex items-center justify-between pt-6">
                        <div>
                            <p className="text-2xl font-bold">7</p>
                            <p className="text-sm text-muted-foreground">Days Streak</p>
                        </div>
                        <div className="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                            <span className="text-sm">🔥</span>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>
    );
}

// Componente WeeklyProgress
function WeeklyProgress() {
    const weekData = [
        { day: 'Mon', progress: 94.3248, completed: true },
        { day: 'Tue', progress: 76.4583, completed: true },
        { day: 'Wed', progress: 8.17128, completed: true },
        { day: 'Thu', progress: 97.4993, completed: true },
        { day: 'Fri', progress: 61.527, completed: true },
        { day: 'Sat', progress: 38.1338, completed: true },
        { day: 'Sun', progress: 72.3739, completed: false },
    ];

    return (
        <Card>
            <CardHeader>
                <CardTitle>Weekly Progress</CardTitle>
                <CardDescription>Exercise completion over the past week</CardDescription>
            </CardHeader>
            <CardContent>
                <div className="space-y-3">
                    {weekData.map((item) => (
                        <div key={item.day} className="flex items-center gap-4">
                            <span className="w-8 text-sm">{item.day}</span>
                            <div className="flex-1 bg-muted rounded-full h-2">
                                <div
                                    className="bg-primary h-2 rounded-full"
                                    style={{ width: `${item.progress}%` }}
                                />
                            </div>
                            <div className="flex gap-1">
                                {item.completed ? (
                                    <CircleCheckBig className="w-4 h-4 text-green-500" />
                                ) : (
                                    <CircleAlert className="w-4 h-4 text-yellow-500" />
                                )}
                            </div>
                        </div>
                    ))}
                </div>
            </CardContent>
        </Card>
    );
}

// Componente Dialog/Modal
function Dialog({ open, onOpenChange, children }) {
    if (!open) return null;

    return (
        <div className="fixed inset-0 z-50 flex items-center justify-center">
            <div
                className="fixed inset-0 bg-black/50"
                onClick={() => onOpenChange(false)}
            />
            <div className="relative bg-background rounded-lg border shadow-lg w-full max-w-[calc(100%-2rem)] sm:max-w-[600px] max-h-[80vh] overflow-y-auto p-6 animate-in fade-in-0 zoom-in-95 duration-200">
                {children}
            </div>
        </div>
    );
}

function DialogHeader({ children }) {
    return <div className="flex flex-col gap-2 text-center sm:text-left">{children}</div>;
}

function DialogTitle({ children }) {
    return <h2 className="text-lg leading-none font-semibold">{children}</h2>;
}

function DialogDescription({ children }) {
    return <p className="text-muted-foreground text-sm">{children}</p>;
}

// Componente Input
function Input({ id, placeholder, value, onChange, className = '' }) {
    return (
        <input
            id={id}
            value={value}
            onChange={(e) => onChange(e.target.value)}
            placeholder={placeholder}
            className={`flex h-9 w-full rounded-md border border-input bg-input-background px-3 py-1 text-sm transition-[color,box-shadow] outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 dark:bg-input/30 ${className}`}
        />
    );
}

// Componente Label
function Label({ htmlFor, children }) {
    return (
        <label
            htmlFor={htmlFor}
            className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-50"
        >
            {children}
        </label>
    );
}

// Componente Textarea
function Textarea({ id, placeholder, value, onChange, className = '' }) {
    return (
        <textarea
            id={id}
            value={value}
            onChange={(e) => onChange(e.target.value)}
            placeholder={placeholder}
            className={`flex min-h-16 w-full rounded-md border border-input bg-input-background px-3 py-2 text-sm transition-[color,box-shadow] outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 dark:bg-input/30 resize-none ${className}`}
        />
    );
}

// Componente Select
function Select({ id, value, onChange, placeholder, options }) {
    return (
        <select
            id={id}
            value={value}
            onChange={(e) => onChange(e.target.value)}
            className="flex h-9 w-full items-center justify-between rounded-md border border-input bg-input-background px-3 py-2 text-sm transition-[color,box-shadow] outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 dark:bg-input/30"
        >
            <option value="">{placeholder}</option>
            {options.map((option) => (
                <option key={option} value={option}>
                    {option}
                </option>
            ))}
        </select>
    );
}

// Componente NewExerciseModal
function NewExerciseModal({ open, onOpenChange, onSave }) {
    const [formData, setFormData] = useState({
        name: '',
        category: '',
        difficulty: '',
        duration: '',
        frequency: '',
        description: '',
        instructions: '',
        benefits: '',
        precautions: '',
    });

    const handleSave = () => {
        onSave(formData);
        setFormData({
            name: '',
            category: '',
            difficulty: '',
            duration: '',
            frequency: '',
            description: '',
            instructions: '',
            benefits: '',
            precautions: '',
        });
        onOpenChange(false);
    };

    return (
        <Dialog open={open} onOpenChange={onOpenChange}>
            <DialogHeader>
                <DialogTitle>Create New Exercise Prescription</DialogTitle>
                <DialogDescription>Add a new therapeutic exercise for the patient.</DialogDescription>
            </DialogHeader>

            <div className="grid gap-4 py-4">
                <div className="space-y-2">
                    <Label htmlFor="exercise-name">Exercise Name</Label>
                    <Input
                        id="exercise-name"
                        placeholder="e.g., Lower Back Stretch"
                        value={formData.name}
                        onChange={(value) => setFormData({ ...formData, name: value })}
                    />
                </div>

                <div className="grid grid-cols-2 gap-4">
                    <div className="space-y-2">
                        <Label htmlFor="category">Category</Label>
                        <Select
                            id="category"
                            value={formData.category}
                            onChange={(value) => setFormData({ ...formData, category: value })}
                            placeholder="Select category"
                            options={['Stretching', 'Strength', 'Breathing', 'Cardio', 'Balance']}
                        />
                    </div>
                    <div className="space-y-2">
                        <Label htmlFor="difficulty">Difficulty</Label>
                        <Select
                            id="difficulty"
                            value={formData.difficulty}
                            onChange={(value) => setFormData({ ...formData, difficulty: value })}
                            placeholder="Select difficulty"
                            options={['Beginner', 'Intermediate', 'Advanced']}
                        />
                    </div>
                </div>

                <div className="grid grid-cols-2 gap-4">
                    <div className="space-y-2">
                        <Label htmlFor="duration">Duration</Label>
                        <Input
                            id="duration"
                            placeholder="e.g., 10-15 minutes"
                            value={formData.duration}
                            onChange={(value) => setFormData({ ...formData, duration: value })}
                        />
                    </div>
                    <div className="space-y-2">
                        <Label htmlFor="frequency">Frequency</Label>
                        <Input
                            id="frequency"
                            placeholder="e.g., Daily, 3x/week"
                            value={formData.frequency}
                            onChange={(value) => setFormData({ ...formData, frequency: value })}
                        />
                    </div>
                </div>

                <div className="space-y-2">
                    <Label htmlFor="description">Description</Label>
                    <Textarea
                        id="description"
                        placeholder="Brief description of the exercise"
                        value={formData.description}
                        onChange={(value) => setFormData({ ...formData, description: value })}
                    />
                </div>

                <div className="space-y-2">
                    <Label htmlFor="instructions">Instructions</Label>
                    <Textarea
                        id="instructions"
                        placeholder="Step-by-step instructions (one per line)"
                        value={formData.instructions}
                        onChange={(value) => setFormData({ ...formData, instructions: value })}
                    />
                </div>

                <div className="space-y-2">
                    <Label htmlFor="benefits">Benefits</Label>
                    <Input
                        id="benefits"
                        placeholder="Expected benefits (comma separated)"
                        value={formData.benefits}
                        onChange={(value) => setFormData({ ...formData, benefits: value })}
                    />
                </div>

                <div className="space-y-2">
                    <Label htmlFor="precautions">Precautions</Label>
                    <Input
                        id="precautions"
                        placeholder="Safety precautions (comma separated)"
                        value={formData.precautions}
                        onChange={(value) => setFormData({ ...formData, precautions: value })}
                    />
                </div>
            </div>

            <div className="flex justify-end gap-2">
                <Button variant="secondary" onClick={() => onOpenChange(false)}>
                    Cancel
                </Button>
                <Button onClick={handleSave}>Create Exercise</Button>
            </div>

            <button
                type="button"
                onClick={() => onOpenChange(false)}
                className="absolute top-4 right-4 rounded-sm opacity-70 transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    className="w-4 h-4"
                >
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
                <span className="sr-only">Close</span>
            </button>
        </Dialog>
    );
}

// Componente Principal
export default function ExercisePrescription() {
    const [activeTab, setActiveTab] = useState('exercises');
    const [isModalOpen, setIsModalOpen] = useState(false);

    const handleSaveExercise = (formData) => {
        console.log('New exercise:', formData);
    };

    return (
        <div className="space-y-6 p-6">
            <div className="flex items-center justify-between">
                <h1 className="text-3xl font-bold">Exercise Prescription</h1>
                <Button onClick={() => setIsModalOpen(true)}>
                    <Plus className="w-4 h-4 mr-2" />
                    New Exercise
                </Button>
            </div>

            <NewExerciseModal
                open={isModalOpen}
                onOpenChange={setIsModalOpen}
                onSave={handleSaveExercise}
            />

            <Tabs activeTab={activeTab} onTabChange={setActiveTab}>
                <Tabs.List>
                    <Tabs.Trigger value="exercises">Exercise Library</Tabs.Trigger>
                    <Tabs.Trigger value="plans">Workout Plans</Tabs.Trigger>
                    <Tabs.Trigger value="progress">Progress Tracking</Tabs.Trigger>
                </Tabs.List>

                <Tabs.Content value="exercises">
                    <ExerciseLibrary />
                </Tabs.Content>

                <Tabs.Content value="plans">
                    <WorkoutPlans />
                </Tabs.Content>

                <Tabs.Content value="progress">
                    <div className="space-y-4">
                        <StatsCards />
                        <WeeklyProgress />
                    </div>
                </Tabs.Content>
            </Tabs>
        </div>
    );
}