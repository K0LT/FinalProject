"use client";
import React from "react";
import { cn } from "./button";

/* Ícones */
const ArrowLeft = (p)=> (<svg viewBox="0 0 24 24" width="16" height="16" {...p}><path d="M15 6l-6 6 6 6" stroke="currentColor" strokeWidth="2" fill="none"/></svg>);
const ArrowRight = (p)=> (<svg viewBox="0 0 24 24" width="16" height="16" {...p}><path d="M9 6l6 6-6 6" stroke="currentColor" strokeWidth="2" fill="none"/></svg>);

const Ctx = React.createContext(null);
export function useCarousel(){ const c = React.useContext(Ctx); if(!c) throw new Error("useCarousel dentro de <Carousel/>"); return c; }

export function Carousel({ className, children, orientation="horizontal", ...props }) {
    const viewportRef = React.useRef(null);
    const [canPrev, setCanPrev] = React.useState(false);
    const [canNext, setCanNext] = React.useState(true);

    const update = React.useCallback(() => {
        const el = viewportRef.current;
        if (!el) return;
        if (orientation === "horizontal") {
            setCanPrev(el.scrollLeft > 0);
            setCanNext(el.scrollLeft + el.clientWidth < el.scrollWidth - 1);
        } else {
            setCanPrev(el.scrollTop > 0);
            setCanNext(el.scrollTop + el.clientHeight < el.scrollHeight - 1);
        }
    }, [orientation]);

    React.useEffect(() => { update(); }, [update]);

    const scrollBy = (delta) => {
        const el = viewportRef.current;
        if (!el) return;
        const opt = { behavior: "smooth" };
        if (orientation === "horizontal") el.scrollBy({ left: delta, ...opt });
        else el.scrollBy({ top: delta, ...opt });
        setTimeout(update, 300);
    };

    const value = {
        viewportRef,
        orientation,
        scrollPrev: ()=>scrollBy(orientation==="horizontal" ? -elSize(viewportRef) : -elSize(viewportRef)),
        scrollNext: ()=>scrollBy(orientation==="horizontal" ?  elSize(viewportRef) :  elSize(viewportRef)),
        canScrollPrev: canPrev,
        canScrollNext: canNext
    };

    return (
        <Ctx.Provider value={value}>
            <div className={cn("relative", className)} role="region" aria-roledescription="carousel" data-slot="carousel" {...props}>
                {children}
            </div>
        </Ctx.Provider>
    );
}

function elSize(ref){ const el = ref.current; return el ? (el.clientWidth || el.clientHeight) : 300; }

export function CarouselContent({ className, ...props }) {
    const { viewportRef, orientation } = useCarousel();
    return (
        <div ref={viewportRef} className="overflow-auto scroll-smooth" data-slot="carousel-content">
            <div className={cn("flex", orientation==="horizontal" ? "-ml-4" : "-mt-4 flex-col", className)} {...props} />
        </div>
    );
}
export function CarouselItem({ className, ...props }) {
    const { orientation } = useCarousel();
    return (
        <div role="group" aria-roledescription="slide" data-slot="carousel-item"
             className={cn("min-w-0 shrink-0 grow-0 basis-full", orientation==="horizontal" ? "pl-4" : "pt-4", className)}
             {...props} />
    );
}
export function CarouselPrevious({ className, ...props }) {
    const { orientation, scrollPrev, canScrollPrev } = useCarousel();
    return (
        <button disabled={!canScrollPrev} onClick={scrollPrev}
                className={cn("absolute size-8 rounded-full border bg-white grid place-items-center",
                    orientation==="horizontal" ? "top-1/2 -left-12 -translate-y-1/2" : "-top-12 left-1/2 -translate-x-1/2 rotate-90",
                    className)} {...props}>
            <ArrowLeft /><span className="sr-only">Anterior</span>
        </button>
    );
}
export function CarouselNext({ className, ...props }) {
    const { orientation, scrollNext, canScrollNext } = useCarousel();
    return (
        <button disabled={!canScrollNext} onClick={scrollNext}
                className={cn("absolute size-8 rounded-full border bg-white grid place-items-center",
                    orientation==="horizontal" ? "top-1/2 -right-12 -translate-y-1/2" : "-bottom-12 left-1/2 -translate-x-1/2 rotate-90",
                    className)} {...props}>
            <ArrowRight /><span className="sr-only">Seguinte</span>
        </button>
    );
}
