BEGIN {
	eleje="<table>"
	vege="</table>"
	soreleje="<tr>"
	sorvege="</tr>"
	mezoeleje="<td>"
	mezovege="</td>"
	FS="[ \t]*;[ \t]*"

	print eleje
}
{
	print soreleje
	for(i=1; i<=NF; i++){
		if($i ~ "§"){
			cmd = "date -d \"$(echo '" $1 "' | sed 's:\\.:/:g')\" +\"%A\""
			cmd | getline abc
            
			print mezoeleje, abc, mezovege
			close(cmd)
		}
		else{
			print mezoeleje, $i, mezovege
		}
	}
	print sorvege
}
END{
	print vege
}
