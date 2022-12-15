const Button = ({ type = 'submit', className, ...props }) => (
    <button
        type={type}
        className={`${className} text-white bg-blue hover:bg-blue-700 font-medium rounded-lg text-sm text-center px-5 py-2.5`}
        {...props}
    />
)

export default Button
