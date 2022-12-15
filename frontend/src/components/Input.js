const Input = ({ disabled = false, className, ...props }) => (
    <input
        disabled={disabled}
        className={`${className} border border-blue-700 focus:border-blue-100 dark:bg-gray-800 text-sm rounded-lg w-full p-2.5`}
        {...props}
    />
)

export default Input
