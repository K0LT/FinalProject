import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/components/ui/Card";

export default function WeeklyProgress() {
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
    );}
