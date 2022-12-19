export default function Button({ type = 'submit', className, ...props }) {
    return(
        <button
            type={type}
            className={`${className} text-white bg-brand hover:bg-black dark:hover:bg-blue-900 font-medium rounded-lg text-sm text-center px-5 py-2.5`}
            {...props}
        />
    )
}
