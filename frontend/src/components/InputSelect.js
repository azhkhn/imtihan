export default function InputSelect({ disabled = false, className, defaultOption, children, ...props }) {
    return(
        <select
            disabled={disabled}
            className={`${className} w-full p-2.5 text-sm rounded-lg border border-brand focus:border-blue-100 dark:bg-gray-800 dark:text-white`}
            {...props}
        >
            <option>{defaultOption}</option>
            {children}
        </select>
    )
}
