import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/components/ui/Card";
import {useState} from "react";
import Button from "@/components/ui/Button";
import Checkbox from "@/components/ui/Checkbox";

export default function WorkoutPlans() {
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
    );}
