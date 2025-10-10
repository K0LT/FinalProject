export default function Topbar() {
    return (
        <div className="h-14 px-4 flex items-center justify-between">
            <div className="text-sm opacity-70">{new Date().getFullYear()}</div>
            <div className="flex items-center gap-3">
        <span className="text-right">
          <div className="text-sm font-medium">José Machado</div>
          <div className="text-xs opacity-70">Acupunturista</div>
        </span>
                <div className="size-8 rounded-full bg-yellow-500" />
            </div>
        </div>
    );
}