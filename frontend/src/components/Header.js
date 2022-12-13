import Link from 'next/link'

const Header = ({ className, name }) => (
    <header
        className={`${className} fixed w-full bg-blue border-gray-200 px-2 sm:px-4 py-2.5 z-10`}>
        <div className="font-medium text-white text-2xl text-center sm:block md:blcok lg:blcok xl:blcok 2xl:blcok block">
            <Link href="/">{name}</Link>
        </div>
    </header>
)
export default Header
