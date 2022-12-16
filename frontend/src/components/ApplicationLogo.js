import Logo from "../../public/imtihan-default.webp";
import Image from "next/image";

export default function ApplicationLogo({ ...props }) {
    return (
        <Image src={Logo} placeholder="blur" {...props}/>
    )
}
