import React from "react";

export default function GoldButton({ href = "#", children, onClick }) {
    const Element = href ? "a" : "button";

    return (
        <Element
            href={href}
            onClick={onClick}
            className="btn btn--gold"
        >
            {children}
        </Element>
    );
}
