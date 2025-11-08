// We pass the names for the buttons, potentially also the buttons in the future
// Depending on which is clicked, we shift the activeButton variable, which is used to determine which card is displayed
export default function ButtonRow({names, activeButton, handleClick}){
    return <div className="flex flex-row mt-4 rounded-lg w-fit h-fit p-1 text-center bg-gray-100">
        {names.map((name) => (
            <button
                key={name.toLowerCase()}
                className={"rounded-lg text-sm px-2 " + (name.toLowerCase() === activeButton ? "bg-white" : "")}
                onClick={() => handleClick(name.toLowerCase())}
            >
                {name}
            </button>
        ))}
    </div>
}