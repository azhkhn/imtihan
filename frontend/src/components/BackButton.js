import Link from 'next/link'
import { ArrowLeftIcon } from '@heroicons/react/24/outline'

export default function BackButton({ href }) {
    return (
        <Link href={href}>
            <ArrowLeftIcon className="fixed text-white top-4 left-4 w-6 h-6 z-10"></ArrowLeftIcon>
        </Link>
    )
}
