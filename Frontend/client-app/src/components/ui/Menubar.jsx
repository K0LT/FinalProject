"use client";

import React from "react";

/* util simples para classes */
function cn(...xs) { return xs.filter(Boolean).join(" "); }

/* Ícones inline */
const CheckIcon = (p) => (
    <svg viewBox="0 0 24 24" width="16" height="16" {...p}>
        <path d="M20 6L9 17l-5-5" stroke="currentColor" strokeWidth="2" fill="none" />
    </svg>
);
const ChevronRightIcon = (p) => (
    <svg viewBox="0 0 24 24" width="16" height="16" {...p}>
        <path d="M9 6l6 6-6 6" stroke="currentColor" strokeWidth="2" fill="none" />
    </svg>
);
const CircleIcon = (p) => (
    <svg viewBox="0 0 24 24" width="10" height="10" {...p}>
        <circle cx="12" cy="12" r="4" fill="currentColor" />
    </svg>
);

/* ---------- Contextos ---------- */
const RootCtx = React.createContext(null);   // controla qual menu principal está aberto
const MenuCtx = React.createContext(null);   // id do menu atual
const RadioCtx = React.createContext(null);  // grupo de radio
const SubCtx   = React.createContext(null);  // submenu (scoped)

/* ---------- Root ---------- */
function Menubar({ className, children, ...props }) {
    const [openId, setOpenId] = React.useState(null);
    const rootRef = React.useRef(null);

    // clique-fora fecha
    React.useEffect(() => {
        const onDoc = (e) => {
            if (!rootRef.current) return;
            if (!rootRef.current.contains(e.target)) setOpenId(null);
        };
        document.addEventListener("mousedown", onDoc);
        return () => document.removeEventListener("mousedown", onDoc);
    }, []);

    // ESC global
    React.useEffect(() => {
        const onKey = (e) => { if (e.key === "Escape") setOpenId(null); };
        document.addEventListener("keydown", onKey);
        return () => document.removeEventListener("keydown", onKey);
    }, []);

    return (
        <RootCtx.Provider value={{ openId, setOpenId }}>
            <div
                ref={rootRef}
                role="menubar"
                className={cn("flex h-9 items-center gap-1 rounded-md border p-1 shadow-sm bg-white", className)}
                {...props}
            >
                {children}
            </div>
        </RootCtx.Provider>
    );
}

/* ---------- Menu (escopo) ---------- */
function MenubarMenu({ id: idProp, children, className, ...props }) {
    const autoId = React.useId();
    const id = idProp ?? autoId; // permite passar id manual se quiseres
    return (
        <MenuCtx.Provider value={{ id }}>
            <div data-slot="menubar-menu" className={cn("relative inline-block", className)} {...props}>
                {children}
            </div>
        </MenuCtx.Provider>
    );
}

/* ---------- Trigger principal ---------- */
function MenubarTrigger({ className, ...props }) {
    const { openId, setOpenId } = React.useContext(RootCtx);
    const { id } = React.useContext(MenuCtx);
    const isOpen = openId === id;

    return (
        <button
            role="menuitem"
            aria-haspopup="menu"
            aria-expanded={isOpen}
            onClick={() => setOpenId(isOpen ? null : id)}
            onMouseEnter={() => setOpenId(id)}          // hover troca de menu
            onKeyDown={(e) => {
                if (["Enter"," "].includes(e.key)) { e.preventDefault(); setOpenId(id); }
                if (e.key === "ArrowDown") { setOpenId(id); }
                if (e.key === "Escape") setOpenId(null);
            }}
            className={cn(
                "flex items-center rounded-sm px-2 py-1 text-sm font-medium select-none",
                isOpen ? "bg-gray-100 text-gray-900" : "hover:bg-gray-50",
                "focus-visible:outline-none focus:bg-gray-100 focus:text-gray-900",
                className
            )}
            {...props}
        />
    );
}

/* ---------- Content do menu principal ---------- */
function MenubarPortal({ children }) { return <>{children}</>; }

function MenubarContent({ className, sideOffset = 8, style, ...props }) {
    const { openId } = React.useContext(RootCtx);
    const { id } = React.useContext(MenuCtx);
    const open = openId === id;

    return (
        <MenubarPortal>
            <div
                role="menu"
                tabIndex={-1}
                data-state={open ? "open" : "closed"}
                className={cn(
                    "absolute left-0 top-full z-50 mt-2 min-w-[12rem] rounded-md border bg-white p-1 shadow-md",
                    open ? "" : "hidden",
                    "animate-in fade-in-0 zoom-in-95",
                    className
                )}
                style={{ marginTop: sideOffset, ...style }}
                {...props}
            />
        </MenubarPortal>
    );
}

/* ---------- Items ---------- */
function MenubarItem({ className, inset, variant = "default", ...props }) {
    const destructive = variant === "destructive";
    return (
        <button
            role="menuitem"
            className={cn(
                "relative flex w-full cursor-default select-none items-center gap-2 rounded-sm px-2 py-1.5 text-sm",
                inset && "pl-8",
                "hover:bg-gray-100 focus:bg-gray-100 focus-visible:outline-none",
                destructive && "text-red-600 hover:bg-red-50 focus:bg-red-50",
                "disabled:pointer-events-none disabled:opacity-50",
                className
            )}
            {...props}
        />
    );
}

function MenubarCheckboxItem({ className, children, checked, ...props }) {
    return (
        <button
            role="menuitemcheckbox"
            aria-checked={!!checked}
            className={cn(
                "relative flex w-full cursor-default select-none items-center gap-2 rounded-sm py-1.5 pr-2 pl-8 text-sm",
                "hover:bg-gray-100 focus:bg-gray-100 focus-visible:outline-none",
                className
            )}
            {...props}
        >
      <span className="pointer-events-none absolute left-2 flex h-4 w-4 items-center justify-center">
        {checked ? <CheckIcon /> : null}
      </span>
            {children}
        </button>
    );
}

function MenubarRadioGroup({ value, onValueChange, children }) {
    const ctx = React.useMemo(() => ({ value, onValueChange }), [value, onValueChange]);
    return (
        <RadioCtx.Provider value={ctx}>
            <div role="group">{children}</div>
        </RadioCtx.Provider>
    );
}

function MenubarRadioItem({ className, children, value, ...props }) {
    const { value: current, onValueChange } = React.useContext(RadioCtx) || {};
    const checked = current === value;

    return (
        <button
            role="menuitemradio"
            aria-checked={!!checked}
            onClick={() => onValueChange && onValueChange(value)}
            className={cn(
                "relative flex w-full cursor-default select-none items-center gap-2 rounded-sm py-1.5 pr-2 pl-8 text-sm",
                "hover:bg-gray-100 focus:bg-gray-100 focus-visible:outline-none",
                className
            )}
            {...props}
        >
      <span className="pointer-events-none absolute left-2 flex h-4 w-4 items-center justify-center">
        {checked ? <CircleIcon /> : <span className="h-2 w-2 rounded-full border" />}
      </span>
            {children}
        </button>
    );
}

function MenubarLabel({ className, inset, ...props }) {
    return (
        <div className={cn("px-2 py-1.5 text-sm font-medium", inset && "pl-8", className)} {...props} />
    );
}

function MenubarSeparator({ className, ...props }) {
    return <div role="separator" className={cn("-mx-1 my-1 h-px bg-gray-200", className)} {...props} />;
}

function MenubarShortcut({ className, ...props }) {
    return <span className={cn("ml-auto text-xs tracking-widest text-gray-500", className)} {...props} />;
}

/* ---------- Submenu (escopo fechado) ---------- */
function MenubarSub({ children, className }) {
    const [open, setOpen] = React.useState(false);
    const ctx = React.useMemo(() => ({ open, setOpen }), [open]);
    return (
        <SubCtx.Provider value={ctx}>
            <div className={cn("relative", className)}>{children}</div>
        </SubCtx.Provider>
    );
}

function MenubarSubTrigger({ className, inset, children, ...props }) {
    const { open, setOpen } = React.useContext(SubCtx);

    return (
        <button
            role="menuitem"
            aria-haspopup="menu"
            aria-expanded={open}
            onMouseEnter={() => setOpen(true)}
            onMouseLeave={() => setOpen(false)}
            onFocus={() => setOpen(true)}
            onBlur={() => setOpen(false)}
            onKeyDown={(e) => {
                if (["Enter"," ","ArrowRight"].includes(e.key)) { e.preventDefault(); setOpen(true); }
                if (["ArrowLeft","Escape"].includes(e.key)) setOpen(false);
            }}
            className={cn(
                "flex w-full cursor-default items-center rounded-sm px-2 py-1.5 text-sm",
                inset && "pl-8",
                "hover:bg-gray-100 focus:bg-gray-100 focus-visible:outline-none",
                className
            )}
            {...props}
        >
            {children}
            <ChevronRightIcon className="ml-auto opacity-70" />
        </button>
    );
}

function MenubarSubContent({ className, style, children, ...props }) {
    const { open, setOpen } = React.useContext(SubCtx);
    if (!open) return null;

    return (
        <div
            role="menu"
            className={cn(
                "absolute left-full top-0 z-50 ml-1 min-w-[8rem] rounded-md border bg-white p-1 shadow-lg",
                className
            )}
            onMouseEnter={() => setOpen(true)}
            onMouseLeave={() => setOpen(false)}
            style={style}
            {...props}
        >
            {children}
        </div>
    );
}

/* ---------- Exports ---------- */
export {
    Menubar,
    MenubarPortal,
    MenubarMenu,
    MenubarTrigger,
    MenubarContent,
    MenubarGroup, // alias de conveniência
    MenubarSeparator,
    MenubarLabel,
    MenubarItem,
    MenubarShortcut,
    MenubarCheckboxItem,
    MenubarRadioGroup,
    MenubarRadioItem,
    MenubarSub,
    MenubarSubTrigger,
    MenubarSubContent,
};

function MenubarGroup(props) { return <div {...props} />; }
