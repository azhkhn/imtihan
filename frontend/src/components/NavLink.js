import Link from "next/link";
export default function NavLink({ name, href, className }) {
    return (
        <Link href={href}>
            <a
                className={`${className} dark:text-white border border-brand hover:bg-brand hover:text-white transition-all rounded-lg`}>
                {name}
            </a>
        </Link>
    )
}
