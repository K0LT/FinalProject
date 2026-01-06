import {Card, CardContent} from "@/components/ui/Card";

export default function StatsCards() {
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
    );}
