import Dialog from "@/components/ui/Dialog";
import {useState} from "react";
import Label from "@/components/ui/Label";
import {DialogHeader} from "@/components/ui/DialogHeader";
import {DialogTitle} from "@/components/ui/DialogTitle";
import {DialogDescription} from "@/components/ui/DialogDescription";
import Input from "@/components/ui/Input";
import Select from "@/components/ui/Select";
import Textarea from "@/components/ui/Textarea";
import Button from "@/components/ui/Button";

export default function NewExerciseModal({ open, onOpenChange, onSave }) {

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