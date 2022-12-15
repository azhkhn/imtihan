export default function AuthCard({ logo, children }) {
    return(
        <>
            {logo}

            <hr className="my-8 w-full h-px bg-gray-200 border-0 dark:bg-gray-700"/>

            <div className="w-96 px-2">
                {children}
            </div>
        </>
    )
}
