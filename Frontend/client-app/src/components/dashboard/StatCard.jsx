"use client";

import React from "react";
import { TrendingUp, TrendingDown } from "lucide-react";

const colorClasses = {
    gold: "from-[#fff9e8] to-[#fdf4d7] border-[#f1dca3]/40 text-[#b8860b]",
    green: "from-green-50 to-green-100 border-green-200 text-green-600",
    purple: "from-purple-50 to-purple-100 border-purple-200 text-purple-600",
    red: "from-red-50 to-red-100 border-red-200 text-red-600",
};

export default function StatCard({
                                     title,
                                     value,
                                     subtitle,
                                     icon: Icon,
                                     color = "gold",
                                     trend,
                                 }) {
    const classes = colorClasses[color] ?? colorClasses.gold;

    return (
        <div className={`bg-gradient-to-br ${classes} border rounded-xl p-4 sm:p-6 hover:shadow-lg transition-shadow`}>
            <div className="flex items-start justify-between gap-3">
                <div className="flex-1 min-w-0">
                    <p className="text-xs sm:text-sm font-medium mb-1 text-gray-800">{title}</p>
                    <p className="text-2xl sm:text-3xl font-bold text-gray-900 mb-1 truncate">{value}</p>
                    {subtitle && (
                        <p className="text-[11px] sm:text-xs opacity-75 text-gray-700">
                            {subtitle}
                        </p>
                    )}
                    {trend && (
                        <div className="flex items-center gap-1 mt-2">
                            {trend.isPositive ? (
                                <TrendingUp className="w-4 h-4 text-emerald-600" />
                            ) : (
                                <TrendingDown className="w-4 h-4 text-red-600" />
                            )}
                            <span
                                className={`text-xs font-semibold ${
                                    trend.isPositive ? "text-emerald-600" : "text-red-600"
                                }`}
                            >
                {trend.value}%
              </span>
                        </div>
                    )}
                </div>
                <div className="p-2 sm:p-3 bg-white/60 rounded-lg flex items-center justify-center">
                    <Icon className="w-5 h-5 sm:w-6 sm:h-6 text-gray-800" />
                </div>
            </div>
        </div>
    );
}
